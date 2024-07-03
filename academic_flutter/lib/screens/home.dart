import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/widgets/bottom_nav_bar.dart'; 
import 'class_screen.dart';
import 'package:academic_flutter/screens/report_screen.dart';
import 'teacher_screen.dart';
import 'subject_screen.dart'; 
import 'package:academic_flutter/services/report_service.dart';

class HomeView extends StatefulWidget {
  @override
  _HomeViewState createState() => _HomeViewState();
}

class _HomeViewState extends State<HomeView> {
  final List<String> catNames = [
    "Kelas",
    "Guru",
    "Pelajaran",
    "Rapor",
  ];

  final List<Color> catColors = [
    Color(0xFFFC7C7F),
    Color(0xFF61BDFD),
    Color(0xFF6FE08D),
    Color(0xFF7469B6),
  ];

  final List<String> catIcons = [
    'assets/icons/class-icon.svg',
    'assets/icons/teachers.svg',
    'assets/icons/subjects.svg',
    'assets/icons/reports.svg',
  ];

  int _currentIndex = 0;

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
      case 2:
        Navigator.of(context).pushReplacementNamed('/profile');
        break;
      default:
        break;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        scrollDirection: Axis.vertical,
        child: Column(
          children: [
            Container(
              padding: EdgeInsets.only(top: 15, left: 15, right: 15, bottom: 10),
              decoration: BoxDecoration(
                color: primaryColor,
                borderRadius: BorderRadius.only(
                  bottomLeft: Radius.circular(20),
                  bottomRight: Radius.circular(20),
                ),
              ),
              child: Column(
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Icon(Icons.dashboard, size: 30, color: Colors.white),
                      Icon(Icons.notifications, size: 30, color: Colors.white),
                    ],
                  ),
                  SizedBox(height: 20),
                  Padding(
                    padding: EdgeInsets.only(left: 3, bottom: 15),
                    child: Text(
                      "Hi, Students",
                      style: TextStyle(
                        fontSize: 25,
                        fontWeight: FontWeight.w600,
                        letterSpacing: 1,
                        wordSpacing: 2,
                        color: Colors.white,
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.only(top: 5, bottom: 20),
                    width: MediaQuery.of(context).size.width,
                    height: 55,
                    alignment: Alignment.center,
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: TextFormField(
                      decoration: InputDecoration(
                        border: InputBorder.none,
                        hintText: "Search here ...",
                        hintStyle: TextStyle(
                          color: Colors.black.withOpacity(0.5),
                        ),
                        prefixIcon: Icon(
                          Icons.search,
                          size: 25,
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
            Padding(
              padding: EdgeInsets.only(top: 20, left: 15, right: 15),
              child: Column(
                children: [
                  GridView.builder(
                    itemCount: catNames.length,
                    shrinkWrap: true,
                    physics: NeverScrollableScrollPhysics(),
                    gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                      crossAxisCount: 2, // Menampilkan dua item dalam satu baris
                      childAspectRatio: 1.1,
                    ),
                    itemBuilder: (context, index) {
                      return InkWell(
                        onTap: () {
                          _navigateToCategoryScreen(index);
                        },
                        child: Container(
                          padding: EdgeInsets.all(10),
                          margin: EdgeInsets.all(5),
                          decoration: BoxDecoration(
                            color: catColors[index], // Sesuaikan dengan catColors jika ingin warna berbeda
                            borderRadius: BorderRadius.circular(10),
                          ),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              SvgPicture.asset(
                                catIcons[index], // Ubah index sesuai dengan yang ingin ditampilkan
                                color: Colors.white,
                                height: 30,
                                width: 30,
                              ),
                              SizedBox(height: 10),
                              Text(
                                catNames[index], // Ubah index sesuai dengan yang ingin ditampilkan
                                textAlign: TextAlign.center,
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.w500,
                                  color: Colors.black.withOpacity(0.7),
                                ),
                              ),
                            ],
                          ),
                        ),
                      );
                    },
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavBar(
        currentIndex: _currentIndex,
        onTap: _onBottomNavTapped,
      ),
    );
  }

  void _navigateToCategoryScreen(int index) {
    // Implementasi navigasi ke layar sesuai dengan kategori yang dipilih
    switch (index) {
      case 0:
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => ClassScreen()),
        );
        break;
      case 1:
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => TeacherScreen()),
        );
        break;
      case 2:
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => SubjectScreen()),
        );
        break;
      case 3:
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => ReportScreen(
              nis: '2110083022', // Contoh NIS
              tahunAjaran: '2023/2024', // Contoh Tahun Ajaran
              semester: '1', // Contoh Semester
              nilaiService: NilaiService(baseUrl: 'http://127.0.0.1:8000/api'),
            ),
          ),
        );
        break;
      default:
        break;
    }
  }
}
