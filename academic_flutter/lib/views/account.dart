import 'package:academic_flutter/widgets/navigation_bar_app.dart';
import 'package:flutter/material.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/widgets/navigation_bar_app.dart';

class AccountView extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('View Profile'),
        backgroundColor: primaryColor, // Menggunakan primaryColor dari constant.dart
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            // Foto profil
            Container(
              padding: EdgeInsets.all(20.0),
              alignment: Alignment.center,
              child: CircleAvatar(
                radius: 70,
                backgroundImage: NetworkImage('https://example.com/profile.jpg'), // Ganti dengan URL foto profil
              ),
            ),
            // Nama pengguna
            Container(
              padding: EdgeInsets.symmetric(horizontal: 20.0),
              child: Text(
                'John Doe', // Ganti dengan nama pengguna
                style: TextStyle(
                  fontSize: 24.0,
                  fontWeight: FontWeight.bold,
                  color: textColor, // Menggunakan textColor dari constant.dart
                ),
              ),
            ),
            SizedBox(height: 10.0),
            // Info tambahan
            Container(
              padding: EdgeInsets.symmetric(horizontal: 20.0),
              child: Text(
                'UI/UX Designer', // Ganti dengan info tambahan
                style: TextStyle(
                  fontSize: 18.0,
                  color: labelColor, // Menggunakan labelColor dari constant.dart
                ),
              ),
            ),
            SizedBox(height: 20.0),
            // Tombol Edit Profil
            Container(
              padding: EdgeInsets.symmetric(horizontal: 20.0),
              child: ElevatedButton(
                onPressed: () {
                  // Aksi ketika tombol ditekan
                },
                child: Text('Edit Profile'),
                style: ElevatedButton.styleFrom(
                  backgroundColor: secondaryColor, // Menggunakan secondaryColor dari constant.dart
                  padding: EdgeInsets.symmetric(vertical: 15.0),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(30.0),
                  ),
                ),
              ),
            ),
            SizedBox(height: 20.0),
            // Tombol Logout, Setting, More Information
            Container(
              padding: EdgeInsets.symmetric(horizontal: 20.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: [
                  ElevatedButton(
                    onPressed: () {
                      // Aksi ketika tombol Logout ditekan
                    },
                    child: Text('Logout'),
                  ),
                  ElevatedButton(
                    onPressed: () {
                      // Aksi ketika tombol Setting ditekan
                    },
                    child: Text('Setting'),
                  ),
                  ElevatedButton(
                    onPressed: () {
                      // Aksi ketika tombol More Information ditekan
                    },
                    child: Text('More Information'),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: NavigationBarApp(),
    );
  }
}

void main() {
  runApp(MaterialApp(
    home: AccountView(),
  ));
}
