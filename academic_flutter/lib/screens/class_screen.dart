import 'package:flutter/material.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/services/class_service.dart';

class ClassScreen extends StatefulWidget {
  @override
  _ClassScreenState createState() => _ClassScreenState();
}

class _ClassScreenState extends State<ClassScreen> {
  List<dynamic> kelasList = [];
  List<dynamic> siswaList = [];
  String selectedKelas = '';
  String selectedNamaKelas = '';
  bool isLoading = false;

  final ClassService _classService = ClassService();

  @override
  void initState() {
    super.initState();
    fetchKelasList();
  }

  Future<void> fetchKelasList() async {
    setState(() {
      isLoading = true;
    });

    try {
      var list = await _classService.fetchKelasList();
      setState(() {
        kelasList = list;
        isLoading = false;
      });
    } catch (e) {
      setState(() {
        isLoading = false;
      });
      // Handle error gracefully
    }
  }

  Future<void> fetchSiswa(String idKelas) async {
    setState(() {
      isLoading = true;
    });

    try {
      var list = await _classService.fetchSiswa(idKelas);
      setState(() {
        siswaList = list;
        isLoading = false;
      });
    } catch (e) {
      setState(() {
        isLoading = false;
      });
      // Handle error gracefully
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: primaryColor,
        title: Text(
          "Kelas",
          style: TextStyle(
            fontSize: 25,
            fontWeight: FontWeight.w600,
            letterSpacing: 1,
            wordSpacing: 2,
            color: Colors.white,
          ),
        ),
        iconTheme: IconThemeData(color: Colors.white),
        actions: [
          IconButton(
            icon: Icon(Icons.refresh,
            color: Colors.white,),
            onPressed: () {
              fetchKelasList();
            },
          ),
        ],
      ),
      body: Stack(
        children: [
          Padding(
            padding: const EdgeInsets.all(12.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                SizedBox(height: 20),
                Text(
                  'Pilih Kelas',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                SizedBox(height: 10),
                Container(
                  padding: EdgeInsets.all(8.0),
                  decoration: BoxDecoration(
                    border: Border.all(color: primaryColor),
                    borderRadius: BorderRadius.circular(5.0),
                  ),
                  child: DropdownButtonFormField(
                    value: selectedKelas.isEmpty ? null : selectedKelas,
                    decoration: InputDecoration(
                      border: InputBorder.none,
                      labelText: 'Kelas',
                      
                    ),
                    items: kelasList.map((kelas) {
                      return DropdownMenuItem(
                        value: kelas['id_kelas'].toString(),
                        child: Text('${kelas['kelas']} ${kelas['nama_kelas']}'),
                      );
                    }).toList(),
                    hint: Text('Pilih Kelas',
                    style: TextStyle(
                                fontSize: 14,
                                color: secondaryColor,
                                fontWeight: FontWeight.bold,
                              ),),
                    onChanged: (value) {
                      setState(() {
                        selectedKelas = value.toString();
                        selectedNamaKelas =
                            '${kelasList.firstWhere((kelas) => kelas['id_kelas'].toString() == selectedKelas)['kelas']} ${kelasList.firstWhere((kelas) => kelas['id_kelas'].toString() == selectedKelas)['nama_kelas']}';
                        fetchSiswa(selectedKelas);
                      });
                    },
                  ),
                ),
                SizedBox(height: 20),
                if (selectedKelas.isNotEmpty)
                  Text(
                    'Daftar Siswa Kelas $selectedNamaKelas',
                    style: TextStyle(color: secondaryColor, fontWeight: FontWeight.bold),
                  ),
                SizedBox(height: 10),
                Expanded(
                  child: isLoading
                      ? Center(child: CircularProgressIndicator())
                      : siswaList.isEmpty
                          ? Center(child: Text('Data siswa tidak ditemukan'))
                          : SingleChildScrollView(
                              scrollDirection: Axis.horizontal,
                              child: Container(
                                width: MediaQuery.of(context).size.width * 0.9,
                                child: DataTable(
                                  columnSpacing: 20,
                                  columns: [
                                    DataColumn(
                                      label: Text('No', 
                                      style: TextStyle(
                                        fontSize: 14,
                                        color: secondaryColor,
                                        fontWeight: FontWeight.bold
                                      ),
                                    ),
                                    ),
                                    DataColumn(label: Text('Nama Siswa',
                                    style: TextStyle(
                                        fontSize: 14,
                                        color: secondaryColor,
                                        fontWeight: FontWeight.bold
                                      ),
                                      ),
                                    ),
                                    DataColumn(label: Text('NIS',
                                    style: TextStyle(
                                        fontSize: 14,
                                        color: secondaryColor,
                                        fontWeight: FontWeight.bold
                                      ),
                                      ),
                                    ),
                                  ],
                                  rows: List.generate(siswaList.length, (index) {
                                    // Alternating row color logic
                                    Color? rowColor = index % 2 == 0 ? secondaryColor: null;

                                    return DataRow(
                                      color: MaterialStateProperty.resolveWith<Color>((Set<MaterialState> states) {
                                        return rowColor ?? Colors.white; // Default to white if no color specified
                                      }),
                                      cells: [
                                        DataCell(Text((index + 1).toString())),
                                        DataCell(Text(siswaList[index]['nama_siswa'])),
                                        DataCell(Text(siswaList[index]['nis'].toString())),
                                      ],
                                    );
                                  }),
                                ),
                              ),
                            ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
