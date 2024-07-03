// import 'package:flutter/material.dart';
// import 'package:academic_flutter/views/welcome.dart';

// class SplashScreen extends StatefulWidget {
//   @override
//   _SplashScreenState createState() => _SplashScreenState();
// }

// class _SplashScreenState extends State<SplashScreen> {
//   @override
//   void initState() {
//     super.initState();
//     _navigateToHome();
//   }

//   _navigateToHome() async {
//     await Future.delayed(Duration(seconds: 3), () {}); // Durasi animasi splash screen
//     Navigator.pushReplacement(
//       context,
//       MaterialPageRoute(builder: (context) => WelcomeView()), // Ganti dengan rute halaman utama Anda
//     );
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       backgroundColor: Colors.white,
//       body: Center(
//         child: Image.asset('assets/welcome.png'), // Ganti dengan path ke file GIF Anda
//       ),
//     );
//   }
// }
