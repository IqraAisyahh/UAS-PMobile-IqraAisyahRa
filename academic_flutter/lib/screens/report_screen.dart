import 'package:academic_flutter/constants/colors.dart';
import 'package:flutter/material.dart';
import 'package:academic_flutter/model/nilai_model.dart';
import 'package:academic_flutter/services/report_service.dart';

class ReportScreen extends StatefulWidget {
  final String nis;
  final String tahunAjaran;
  final String semester;
  final NilaiService nilaiService;

  ReportScreen({
    required this.nis,
    required this.tahunAjaran,
    required this.semester,
    required this.nilaiService,
  });

  @override
  _ReportScreenState createState() => _ReportScreenState();
}

class _ReportScreenState extends State<ReportScreen> {
  final _formKey = GlobalKey<FormState>();
  final _nisController = TextEditingController();
  final _tahunAjaranController = TextEditingController();
  final _semesterController = TextEditingController();

  late Future<List<Nilai>> _futureNilai;
  double totalNilai = 0.0;
  double rataRata = 0.0;

  @override
  void initState() {
    super.initState();
    // Initialize controllers with passed values
    _nisController.text = widget.nis;
    _tahunAjaranController.text = widget.tahunAjaran;
    _semesterController.text = widget.semester;

    _futureNilai = Future.value([]); // Initialize with an empty list
  }

  void _searchNilai() {
    if (_formKey.currentState!.validate()) {
      setState(() {
        _futureNilai = widget.nilaiService.fetchNilai(
          _nisController.text,
          _tahunAjaranController.text,
          _semesterController.text,
        );
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Rapor Nilai',
          style: TextStyle(
            fontSize: 25,
            fontWeight: FontWeight.w600,
            letterSpacing: 1,
            wordSpacing: 2,
            color: Colors.white,
          ),
        ),
        backgroundColor: primaryColor, // Adjust header color to match your design
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            Form(
              key: _formKey,
              child: Column(
                children: [
                  TextFormField(
                    controller: _nisController,
                    decoration: InputDecoration(labelText: 'NIS'),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please enter NIS';
                      }
                      return null;
                    },
                  ),
                  TextFormField(
                    controller: _tahunAjaranController,
                    decoration: InputDecoration(labelText: 'Tahun Ajaran'),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please enter Tahun Ajaran';
                      }
                      return null;
                    },
                  ),
                  TextFormField(
                    controller: _semesterController,
                    decoration: InputDecoration(labelText: 'Semester'),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Please enter Semester';
                      }
                      return null;
                    },
                  ),
                  SizedBox(height: 20),
                  ElevatedButton(
                    onPressed: _searchNilai,
                    child: Text('Search'),
                  ),
                ],
              ),
            ),
            SizedBox(height: 20),
            Expanded(
              child: FutureBuilder<List<Nilai>>(
                future: _futureNilai,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('Data nilai tidak ditemukan'));
                  } else {
                    List<Nilai> nilai = snapshot.data!;

                    // Calculate totalNilai and rataRata
                    double total = 0.0;
                    nilai.forEach((nilai) {
                      total += nilai.totalNilai;
                    });
                    totalNilai = total;
                    rataRata = totalNilai / nilai.length;

                    return SingleChildScrollView(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Container(
                            decoration: BoxDecoration(
                              gradient: LinearGradient(
                                colors: [Colors.blue, Colors.lightBlue],
                                begin: Alignment.topCenter,
                                end: Alignment.bottomCenter,
                              ),
                            ),
                            padding: EdgeInsets.all(20.0),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: <Widget>[
                                Text(
                                  'Nama Siswa: ${nilai.first.namaSiswa}',
                                  style: TextStyle(fontSize: 18, color: Colors.white),
                                ),
                                SizedBox(height: 8),
                                Text(
                                  'Nomor Induk Siswa: ${_nisController.text}',
                                  style: TextStyle(fontSize: 18, color: Colors.white),
                                ),
                                SizedBox(height: 8),
                                Text(
                                  'Semester: ${_semesterController.text}',
                                  style: TextStyle(fontSize: 18, color: Colors.white),
                                ),
                                SizedBox(height: 8),
                                Text(
                                  'Tahun Ajaran: ${_tahunAjaranController.text}',
                                  style: TextStyle(fontSize: 18, color: Colors.white),
                                ),
                              ],
                            ),
                          ),
                          SizedBox(height: 20),
                          DataTable(
                            columns: [
                              DataColumn(label: Text('No.')),
                              DataColumn(label: Text('Mata Pelajaran')),
                              DataColumn(label: Text('Nilai')),
                              DataColumn(label: Text('Predikat')),
                            ],
                            rows: nilai.map((data) {
                              int index = nilai.indexOf(data) + 1;
                              return DataRow(cells: [
                                DataCell(Text(index.toString())),
                                DataCell(Text(data.namaMapel)),
                                DataCell(Text(data.totalNilai.toString())),
                                DataCell(Text(data.predikat)),
                              ]);
                            }).toList(),
                          ),
                          SizedBox(height: 20),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.end,
                            children: [
                              Text(
                                'Total: $totalNilai',
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                              SizedBox(width: 20),
                              Text(
                                'Rata-Rata: ${rataRata.toStringAsFixed(2)}',
                                style: TextStyle(fontWeight: FontWeight.bold),
                              ),
                            ],
                          ),
                        ],
                      ),
                    );
                  }
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
