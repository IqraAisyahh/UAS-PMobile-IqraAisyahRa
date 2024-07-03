import 'package:flutter/material.dart';
import 'package:academic_flutter/widgets/bottom_nav_bar.dart'; // Pastikan import widget BottomNavBar

class GradesView extends StatefulWidget {
  const GradesView({Key? key}) : super(key: key);

  @override
  State<GradesView> createState() => _GradesViewState();
}

class _GradesViewState extends State<GradesView> {
  int _currentIndex = 2; // Initialize _currentIndex for BottomNavBar

  // Method to handle bottom navigation bar taps
  void _onBottomNavTapped(int index) {
    setState(() {
      _currentIndex = index;
    });

    switch (index) {
      case 0:
        Navigator.of(context).pushReplacementNamed('/home');
        break;
      case 1:
        Navigator.of(context).pushReplacementNamed('/schedule');
        break;
      case 2: // Already on GradesView, no action needed
        break;
      case 3:
        Navigator.of(context).pushReplacementNamed('/profile');
        break;
      default:
        break;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Dashboard"),
        actions: const [],
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: const EdgeInsets.all(10.0),
          child: Column(
            children: [
              // Your widgets for the body content here
            ],
          ),
        ),
      ),
      bottomNavigationBar: BottomNavBar(
        currentIndex: _currentIndex,
        onTap: _onBottomNavTapped,
      ),
    );
  }
}
