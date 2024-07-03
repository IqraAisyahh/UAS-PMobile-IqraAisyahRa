import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class NISInputScreen extends StatefulWidget {
  @override
  _NISInputScreenState createState() => _NISInputScreenState();
}

class _NISInputScreenState extends State<NISInputScreen> {
  final TextEditingController _nisController = TextEditingController();
  bool _isLoading = false;
  String? _errorMessage;

  Future<void> _fetchStudentData(String nis) async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    final response = await http.post(
      Uri.parse('http://127.0.0.1:8000/api/siswa/verify'),
      body: {'nis': nis},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      if (data['success']) {
        // Berhasil mendapatkan data siswa
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => StudentDetailScreen(data: data['data']),
          ),
        );
      } else {
        // Gagal mendapatkan data siswa
        setState(() {
          _errorMessage = data['message'];
        });
      }
    } else {
      // Error pada API
      setState(() {
        _errorMessage = 'Error connecting to the server';
      });
    }

    setState(() {
      _isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Input NIS'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            TextField(
              controller: _nisController,
              decoration: InputDecoration(
                labelText: 'NIS',
                errorText: _errorMessage,
              ),
              keyboardType: TextInputType.number,
            ),
            SizedBox(height: 20),
            _isLoading
                ? CircularProgressIndicator()
                : ElevatedButton(
                    onPressed: () {
                      if (_nisController.text.isNotEmpty) {
                        _fetchStudentData(_nisController.text);
                      }
                    },
                    child: Text('Submit'),
                  ),
          ],
        ),
      ),
    );
  }
}

class StudentDetailScreen extends StatelessWidget {
  final Map<String, dynamic> data;

  StudentDetailScreen({required this.data});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Student Detail'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('NIS: ${data['nis']}'),
            Text('Nama: ${data['nama_siswa']}'), // Ubah 'nama' menjadi 'nama_siswa'
            Text('Tempat Lahir: ${data['tempat_lahir']}'),
            Text('Tanggal Lahir: ${data['tanggal_lahir']}'),
            Text('Jenis Kelamin: ${data['jenis_kelamin']}'),
            Text('Agama: ${data['agama']}'),
            Text('Alamat: ${data['alamat']}'),
            Text('No Telp: ${data['no_telp']}'),
          ],
        ),
      ),
    );
  }
}
