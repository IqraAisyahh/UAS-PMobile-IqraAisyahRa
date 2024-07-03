import 'package:flutter/material.dart';
import 'package:academic_flutter/screens/home.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/screens/components/already_have_an_account_check.dart';
import 'package:academic_flutter/screens/signup/signup_screen.dart';
import 'package:academic_flutter/services/api_service.dart';
import 'package:shared_preferences/shared_preferences.dart';


class LoginForm extends StatefulWidget {
  const LoginForm({Key? key}) : super(key: key);

  @override
  _LoginFormState createState() => _LoginFormState();
}

class _LoginFormState extends State<LoginForm> {
  final _formKey = GlobalKey<FormState>();
  String _email = '';
  String _password = '';

  void _login() async {
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();
      try {
        final response = await ApiService.login(_email, _password);
        if (response['status'] ?? false) {
          // Save user ID to SharedPreferences
          final int userId = response['user']['id'];
          SharedPreferences prefs = await SharedPreferences.getInstance();
          await prefs.setInt('userId', userId);

          Navigator.pushReplacement(
            context,
            MaterialPageRoute(builder: (context) => HomeView()),
          );
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text(response['message'] ?? 'Login failed')),
          );
        }
      } catch (e) {
        print('Exception during login: $e');
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Login failed. Please try again.')),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Form(
      key: _formKey,
      child: Column(
        children: [
          TextFormField(
            keyboardType: TextInputType.emailAddress,
            textInputAction: TextInputAction.next,
            cursorColor: kPrimaryColor,
            onSaved: (email) => _email = email!,
            validator: (value) {
              if (value == null || value.isEmpty) {
                return 'Enter your email';
              }
              return null;
            },
            decoration: InputDecoration(
              hintText: "Your email",
              prefixIcon: Padding(
                padding: EdgeInsets.all(8.0),
                child: Icon(Icons.person),
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 16.0),
            child: TextFormField(
              textInputAction: TextInputAction.done,
              obscureText: true,
              cursorColor: kPrimaryColor,
              onSaved: (password) => _password = password!,
              validator: (value) {
                if (value == null || value.isEmpty) {
                  return 'Enter your password';
                }
                return null;
              },
              decoration: InputDecoration(
                hintText: "Your password",
                prefixIcon: Padding(
                  padding: EdgeInsets.all(8.0),
                  child: Icon(Icons.lock),
                ),
              ),
            ),
          ),
          SizedBox(height: 16.0),
          ElevatedButton(
            onPressed: _login,
            child: Text(
              "Login".toUpperCase(),
            ),
          ),
          SizedBox(height: 16.0),
          AlreadyHaveAnAccountCheck(
            press: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => const SignUpScreen(),
                ),
              );
            },
          ),
        ],
      ),
    );
  }
}
