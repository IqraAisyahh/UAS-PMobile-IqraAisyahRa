import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/screens/components/already_have_an_account_check.dart';
import 'package:academic_flutter/screens/login/login_screen.dart';
import 'package:academic_flutter/screens/home.dart';

class SignUpForm extends StatefulWidget {
  const SignUpForm({Key? key}) : super(key: key);

  @override
  _SignUpFormState createState() => _SignUpFormState();
}

class _SignUpFormState extends State<SignUpForm> {
  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  Future<void> _register() async {
    String name = _nameController.text.trim();
    String email = _emailController.text.trim();
    String password = _passwordController.text.trim();

    // Validasi sederhana
    if (name.isEmpty || email.isEmpty || password.isEmpty) {
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: Text('Error'),
          content: Text('Name, email, and password cannot be empty.'),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: Text('OK'),
            ),
          ],
        ),
      );
      return;
    }

    // Siapkan data untuk dikirimkan ke API
    Map<String, String> data = {
      'nama': name,
      'email': email,
      'password': password,
    };

    // Kirim permintaan POST ke API
    var url = Uri.parse('http://127.0.0.1:8000/api/register'); // Ganti dengan URL API Anda
    var response = await http.post(
      url,
      body: data,
    );

    // Periksa status kode respons dari API
    if (response.statusCode == 201) {
      // Jika sukses, tampilkan pesan sukses
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: Text('Success'),
          content: Text('Registration successful.'),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.pop(context); // Tutup dialog
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => HomeView()),
                ); // Navigasi ke halaman HomeView
              },
              child: Text('OK'),
            ),
          ],
        ),
      );
    } else {
      // Jika gagal, tampilkan pesan error dari API
      var jsonResponse = jsonDecode(response.body);
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: Text('Error'),
          content: Text(jsonResponse['message'] ?? 'Unknown error occurred.'),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: Text('OK'),
            ),
          ],
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Form(
      child: Column(
        children: [
          TextFormField(
            controller: _nameController,
            keyboardType: TextInputType.text,
            textInputAction: TextInputAction.next,
            cursorColor: kPrimaryColor,
            decoration: const InputDecoration(
              hintText: "Your name",
              prefixIcon: Padding(
                padding: EdgeInsets.all(12.0),
                child: Icon(Icons.person),
              ),
            ),
          ),
          TextFormField(
            controller: _emailController,
            keyboardType: TextInputType.emailAddress,
            textInputAction: TextInputAction.next,
            cursorColor: kPrimaryColor,
            decoration: const InputDecoration(
              hintText: "Your email",
              prefixIcon: Padding(
                padding: EdgeInsets.all(12.0),
                child: Icon(Icons.mail),
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 12.0),
            child: TextFormField(
              controller: _passwordController,
              textInputAction: TextInputAction.done,
              obscureText: true,
              cursorColor: kPrimaryColor,
              decoration: const InputDecoration(
                hintText: "Your password",
                prefixIcon: Padding(
                  padding: EdgeInsets.all(12.0),
                  child: Icon(Icons.lock),
                ),
              ),
            ),
          ),
          SizedBox(height: 12.0),
          ElevatedButton(
            onPressed: _register, // Panggil fungsi _register saat tombol ditekan
            child: Text("Sign Up".toUpperCase()),
          ),
          SizedBox(height: 12.0),
          AlreadyHaveAnAccountCheck(
            login: false,
            press: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => const LoginScreen(),
                ),
              );
            },
          ),
        ],
      ),
    );
  }
}
