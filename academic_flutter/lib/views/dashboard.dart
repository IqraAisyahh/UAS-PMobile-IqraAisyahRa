import 'package:academic_flutter/constants/images.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/layout.dart';
import 'package:flutter/material.dart';

class DashboardView extends StatefulWidget {
  const DashboardView({super.key});

  @override
  State<DashboardView> createState() => _DashboardViewState();
}

class _DashboardViewState extends State<DashboardView> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: tertiaryColor,
      body: ListView(
        padding: EdgeInsets.zero,
        children: [
          Container(
            decoration: const BoxDecoration(
              color: primaryColor,
              borderRadius: BorderRadius.only(
                bottomRight: Radius.circular(10),
              ),
            ),
            child: Column(
              children: [
                const SizedBox(height: 50),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 10.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text('Hello Iqra Aisyah!',
                              style: TextStyle(
                                fontSize: 20,
                                fontWeight: FontWeight.bold,
                                color: Colors.white,
                              )),
                          Text(
                            'Good Morning',
                            style: Theme.of(context)
                                .textTheme
                                .titleMedium
                                ?.copyWith(color: Colors.white54),
                          ),
                        ],
                      ),
                    ),
                    const Spacer(),
                    const CircleAvatar(
                      radius: 30,
                      backgroundImage: AssetImage(welcomeImage),
                    ),
                    const SizedBox(width: 10)
                  ],
                ),
                const SizedBox(height: 10)
              ],
            ),
          ),
          Container(
            color: primaryColor,
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              decoration: const BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(200),
                ),
              ),
              child: GridView.count(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                crossAxisCount: 2,
                crossAxisSpacing: 30,
                mainAxisSpacing: 30,
                children: [
                  cardHolder(
                    'Home',
                    Icons.home_outlined,
                    Colors.orange,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const Layout(),
                      ),
                    ),
                  ),
                  cardHolder(
                    'Report',
                    Icons.graphic_eq_outlined,
                    Colors.green,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const DashboardView(),
                      ),
                    ),
                  ),
                  cardHolder(
                    'Class',
                    Icons.group_outlined,
                    Colors.purple,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const DashboardView(),
                      ),
                    ),
                  ),
                  cardHolder(
                    'Forum',
                    Icons.chat_bubble_outline,
                    Colors.brown,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const DashboardView(),
                      ),
                    ),
                  ),
                  cardHolder(
                    'Account',
                    Icons.money_outlined,
                    Colors.indigo,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const DashboardView(),
                      ),
                    ),
                  ),
                  cardHolder(
                    'Upload',
                    Icons.add_circle_outline,
                    Colors.teal,
                    () => Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const DashboardView(),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
          const SizedBox(height: 20)
        ],
      ),
    );
  }

  cardHolder(String title, IconData iconData, Color background,
          VoidCallback onTap) =>
      GestureDetector(
        onTap: onTap,
        child: Container(
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(10),
            boxShadow: [
              BoxShadow(
                offset: const Offset(0, 5),
                color: primaryColor.withOpacity(.2),
                spreadRadius: 2,
                blurRadius: 5,
              )
            ],
          ),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: background,
                  shape: BoxShape.circle,
                ),
                child: Icon(iconData, color: Colors.white),
              ),
              const SizedBox(height: 8),
              Text(
                title.toUpperCase(),
                style: const TextStyle(
                  fontWeight: FontWeight.w500,
                  fontSize: 16,
                ),
              )
            ],
          ),
        ),
      );
}