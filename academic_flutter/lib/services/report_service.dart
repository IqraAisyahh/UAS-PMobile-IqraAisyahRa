import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:academic_flutter/model/nilai_model.dart';

class NilaiService {
  final String baseUrl;

  NilaiService({required this.baseUrl});

  Future<List<Nilai>> fetchNilai(String nis, String tahunAjaran, String semester) async {
    final url = Uri.parse('$baseUrl/nilai/search-api?nis=$nis&tahun_ajaran=$tahunAjaran&semester=$semester');

    final response = await http.get(url);

    if (response.statusCode == 200) {
      List<dynamic> data = json.decode(response.body);
      return data.map((json) => Nilai.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load nilai');
    }
  }
}
