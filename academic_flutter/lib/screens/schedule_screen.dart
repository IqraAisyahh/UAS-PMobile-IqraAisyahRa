import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:academic_flutter/widgets/bottom_nav_bar.dart'; // Assuming BottomNaviBar is correctly imported from widgets/bottom_nav_bar.dart
import 'package:academic_flutter/constants/colors.dart'; // Adjust import if necessary
import 'package:academic_flutter/services/schedule_service.dart';

class ScheduleScreen extends StatefulWidget {
  @override
  _ScheduleScreenState createState() => _ScheduleScreenState();
}

class _ScheduleScreenState extends State<ScheduleScreen> {
  Map<int, List<Map<String, dynamic>>> groupedScheduleData = {};
  List<dynamic> kelasList = [];
  int _currentIndex = 1;

  final ScheduleService scheduleService = ScheduleService(); // Instance of ScheduleService

  @override
  void initState() {
    super.initState();
    fetchJadwalData();
    fetchKelasList();
  }

  Future<void> fetchJadwalData() async {
    try {
      Map<int, List<Map<String, dynamic>>> groupedData = await scheduleService.fetchJadwalData();

      setState(() {
        groupedScheduleData = groupedData;
      });
    } catch (e) {
      print('Error fetching schedule data: $e');
    }
  }

  Future<void> fetchKelasList() async {
    final url = Uri.parse('http://127.0.0.1:8000/api/kelas'); // Adjust endpoint if needed
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body);
        setState(() {
          kelasList = responseData['kelas'] ?? [];
        });
      } else {
        print('Gagal memuat data kelas');
      }
    } catch (e) {
      print('Error: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Jadwal Kelas',
          style: TextStyle(
            fontSize: 25,
            fontWeight: FontWeight.w600,
            letterSpacing: 1,
            wordSpacing: 2,
            color: Colors.white,
          ),
        ),
        automaticallyImplyLeading: false, // Hilangkan tombol back
        backgroundColor: primaryColor, // Sesuaikan dengan warna yang diinginkan
      ),
      body: Container(
        color: secondaryColor, // Sesuaikan dengan warna yang diinginkan
        child: groupedScheduleData.isNotEmpty
            ? ListView.builder(
                itemCount: groupedScheduleData.length,
                itemBuilder: (context, index) {
                  int idKelas = groupedScheduleData.keys.elementAt(index);
                  List<Map<String, dynamic>> jadwals = groupedScheduleData[idKelas] ?? [];

                  // Ambil data kelas dari jadwal pertama (asumsi kelas sama untuk semua jadwal di grup)
                  String namaKelas = jadwals.isNotEmpty
                      ? jadwals.first['kelas']['nama_kelas'] ?? 'Nama Kelas Tidak Tersedia'
                      : 'Nama Kelas Tidak Tersedia';
                  String tingkatKelas = jadwals.isNotEmpty
                      ? jadwals.first['kelas']['kelas'] ?? 'Tingkat Kelas Tidak Tersedia'
                      : 'Tingkat Kelas Tidak Tersedia';

                  return Card(
                    margin: EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                    color: Colors.white,
                    elevation: 4,
                    child: Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Kelas: $namaKelas',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 18,
                              color: primaryColor,
                            ),
                          ),
                          SizedBox(height: 4),
                          Text(
                            'Tingkat: $tingkatKelas',
                            style: TextStyle(fontStyle: FontStyle.italic),
                          ),
                          Divider(thickness: 2, height: 20),
                          ListView.builder(
                            physics: NeverScrollableScrollPhysics(),
                            shrinkWrap: true,
                            itemCount: jadwals.length,
                            itemBuilder: (context, idx) {
                              final jadwal = jadwals[idx];
                              return ListTile(
                                title: Text(jadwal['hari']),
                                subtitle: Text('${jadwal['jam_masuk']} - ${jadwal['jam_keluar']}'),
                                trailing: Text(jadwal['mapel']['nama_mapel']),
                              );
                            },
                          ),
                        ],
                      ),
                    ),
                  );
                },
              )
            : Center(child: CircularProgressIndicator()),
      ),
      bottomNavigationBar: BottomNavBar(
        currentIndex: _currentIndex,
        onTap: _onBottomNavTapped,
      ),
    );
  }

  void _onBottomNavTapped(int index) {
    setState(() {
      _currentIndex = index;
    });

    switch (index) {
      case 0:
        Navigator.of(context).pushReplacementNamed('/home');
        break;
      case 1:
        // Current screen, do nothing
        break;
      case 2:
        Navigator.of(context).pushReplacementNamed('/profile');
        break;
      case 3:
        Navigator.of(context).pushReplacementNamed('/grades');
        break;
      default:
        break;
    }
  }
}
