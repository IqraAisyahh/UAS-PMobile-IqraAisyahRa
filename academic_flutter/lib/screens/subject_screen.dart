import 'package:flutter/material.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/services/subject_service.dart';
import 'package:academic_flutter/model/mapel_model.dart';

class SubjectScreen extends StatefulWidget {
  @override
  _SubjectScreenState createState() => _SubjectScreenState();
}

class _SubjectScreenState extends State<SubjectScreen> {
  late Future<List<MataPelajaran>> mataPelajaranList;
  final ApiService apiService = ApiService();
  TextEditingController searchController = TextEditingController();
  List<MataPelajaran> filteredMataPelajaranList = [];

  @override
  void initState() {
    super.initState();
    mataPelajaranList = apiService.getMataPelajaran();
  }

  void filterMataPelajaranList(String query) {
    setState(() {
      // Wait for mataPelajaranList to complete, then filter
      mataPelajaranList.then((list) {
        filteredMataPelajaranList = list
            .where((mataPelajaran) =>
                mataPelajaran.namaMapel.toLowerCase().contains(query.toLowerCase()))
            .toList();
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        title: Text(
          'Mata Pelajaran',
          style: TextStyle(
            fontSize: 25,
            fontWeight: FontWeight.w600,
            letterSpacing: 1,
            wordSpacing: 2,
            color: Colors.white,
          ),
        ),
        iconTheme: IconThemeData(color: Colors.white),
      ),
      body: Container(
        width: double.infinity,
        margin: const EdgeInsets.all(10),
        decoration: BoxDecoration(
          color: Colors.white,
        ),
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: TextField(
                controller: searchController,
                onChanged: (value) {
                  filterMataPelajaranList(value);
                },
                decoration: InputDecoration(
                  labelText: 'Cari Mata Pelajaran',
                  labelStyle: TextStyle(color: secondaryColor),
                  border: OutlineInputBorder(),
                  prefixIcon: Icon(Icons.search, color: secondaryColor),
                ),
                style: TextStyle(color: primaryColor),
              ),
            ),
            Expanded(
              child: FutureBuilder<List<MataPelajaran>>(
                future: mataPelajaranList,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('No Data Available'));
                  } else {
                    List<MataPelajaran> displayList = filteredMataPelajaranList.isNotEmpty
                        ? filteredMataPelajaranList
                        : snapshot.data!;

                    return SingleChildScrollView(
                      scrollDirection: Axis.horizontal,
                      child: DataTable(
                        columnSpacing: 30,
                        columns: const [
                          DataColumn(
                            label: Text(
                              "No",
                              style: TextStyle(
                                fontSize: 14,
                                color: secondaryColor,
                                fontWeight: FontWeight.bold,
                              ),
                              textAlign: TextAlign.center,
                            ),
                            numeric: true,
                          ),
                          DataColumn(
                            label: Text(
                              "Pelajaran",
                              style: TextStyle(
                                fontSize: 14,
                                color: secondaryColor,
                                fontWeight: FontWeight.bold,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                          DataColumn(
                            label: Text(
                              "Pengajar",
                              style: TextStyle(
                                fontSize: 14,
                                color: secondaryColor,
                                fontWeight: FontWeight.bold,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ],
                        rows: displayList.map((mataPelajaran) {
                          // Conditionally set color based on data
                          Color? rowColor = mataPelajaran.id % 2 == 0 ? secondaryColor : null;

                          return DataRow(
                            color: MaterialStateProperty.resolveWith<Color>((Set<MaterialState> states) {
                              return rowColor ?? Colors.white; // Use rowColor if set, otherwise default color
                            }),
                            cells: [
                              DataCell(Text(mataPelajaran.id.toString())),
                              DataCell(Text(mataPelajaran.namaMapel)),
                              DataCell(Text(mataPelajaran.namaGuru)),
                            ],
                          );
                        }).toList(),
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
