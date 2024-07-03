import 'package:flutter/material.dart';
import 'package:academic_flutter/screens/welcome/welcome_screen.dart';
import 'package:academic_flutter/screens/home.dart';
import 'package:academic_flutter/screens/schedule_screen.dart';
import 'package:academic_flutter/screens/profile.dart'; 

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Academic Flutter',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      initialRoute: '/login',  // Set initial route to ProfileView
      routes: {
        '/': (context) => WelcomeScreen(),
        '/home': (context) => HomeView(),
        '/schedule': (context) => ScheduleScreen(),
        '/profile': (context) => ProfileScreen(),
      },
    );
  }
}
