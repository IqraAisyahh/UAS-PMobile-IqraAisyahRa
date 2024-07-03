import 'package:flutter/material.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/screens/home.dart'; // import file HomeView

void main() => runApp(const NavigationBarApp());

class NavigationBarApp extends StatelessWidget {
  const NavigationBarApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(useMaterial3: true),
      home: const NavigationExample(),
    );
  }
}

class NavigationExample extends StatefulWidget {
  const NavigationExample({super.key});

  @override
  State<NavigationExample> createState() => _NavigationExampleState();
}

class _NavigationExampleState extends State<NavigationExample> {
  int currentPageIndex = 0;

  final List<Widget> _pages = [
    HomeView(), // Halaman Home
    NotificationsView(), // Gantikan dengan halaman notifikasi Anda
    MessagesView(), // Gantikan dengan halaman pesan Anda
    ProfileView(), // Gantikan dengan halaman profil Anda
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: IndexedStack(
        index: currentPageIndex,
        children: _pages,
      ),
      bottomNavigationBar: NavigationBar(
        onDestinationSelected: (int index) {
          setState(() {
            currentPageIndex = index;
          });
        },
        indicatorColor: primaryColor,
        selectedIndex: currentPageIndex,
        destinations: const <NavigationDestination>[
          NavigationDestination(
            selectedIcon: Icon(Icons.home),
            icon: Icon(Icons.home_outlined),
            label: 'Home',
          ),
          NavigationDestination(
            selectedIcon: Icon(Icons.notifications_sharp),
            icon: Badge(child: Icon(Icons.notifications_outlined)),
            label: 'Notifications',
          ),
          NavigationDestination(
            selectedIcon: Icon(Icons.message_sharp),
            icon: Badge(
              label: Text('2'),
              child: Icon(Icons.messenger_outline_sharp),
            ),
            label: 'Messages',
          ),
          NavigationDestination(
            selectedIcon: Icon(Icons.person_3),
            icon: Badge(
              label: Text('2'),
              child: Icon(Icons.person_3_outlined),
            ),
            label: 'Profile',
          ),
        ],
      ),
    );
  }
}

// Contoh widget halaman lain
class NotificationsView extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Center(child: Text('Notifications Page'));
  }
}

class MessagesView extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Center(child: Text('Messages Page'));
  }
}

class ProfileView extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Center(child: Text('Profile Page'));
  }
}
