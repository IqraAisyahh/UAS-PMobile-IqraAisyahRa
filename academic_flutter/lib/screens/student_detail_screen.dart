import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class StudentDetailsScreen extends StatefulWidget {
  final String nis;

  const StudentDetailsScreen({Key? key, required this.nis}) : super(key: key);

  @override
  _StudentDetailsScreenState createState() => _StudentDetailsScreenState();
}

class _StudentDetailsScreenState extends State<StudentDetailsScreen> {
  String _nis = '';

  @override
  void initState() {
    super.initState();
    _loadNIS();
  }

  void _loadNIS() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _nis = prefs.getString('nis') ?? widget.nis;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Student Details'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text(
              'NIS: $_nis',
              style: TextStyle(fontSize: 24),
            ),
            // Add more details as needed
          ],
        ),
      ),
    );
  }
}
