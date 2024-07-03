import 'dart:convert';
import 'package:http/http.dart' as http;

class ScheduleService {
  Future<Map<int, List<Map<String, dynamic>>>> fetchJadwalData() async {
    final url = Uri.parse('https://0f63-125-165-105-222.ngrok-free.app/api/jadwal');
    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body);

        // Ambil data jadwals dari respons
        List<dynamic> jadwals = responseData['jadwals'] ?? [];

        // Kelompokkan data jadwal berdasarkan id_kelas
        Map<int, List<Map<String, dynamic>>> groupedData = {};
        jadwals.forEach((jadwal) {
          int idKelas = jadwal['id_kelas'];
          groupedData[idKelas] ??= [];
          groupedData[idKelas]?.add(jadwal);
        });

        return groupedData;
      } else {
        throw Exception('Failed to load schedule data');
      }
    } catch (e) {
      throw Exception('Error: $e');
    }
  }
}
