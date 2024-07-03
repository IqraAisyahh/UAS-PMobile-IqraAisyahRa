import 'package:flutter/material.dart';
import 'package:academic_flutter/constants/colors.dart';
import 'package:academic_flutter/widgets/navigation_bar_app.dart';
import 'package:academic_flutter/widgets/bottom_nav_bar_container.dart';

// Mendefinisikan bottom navigation bar items secara global
const List<Map<String, dynamic>> bottomNavigationBarItems = [
  {
    'icon': 'path_to_icon1.svg',
    'view': (), 
  },
  {
    'icon': 'path_to_icon2.svg',
    'view': (), 
  },
  // Tambahkan item lain sesuai kebutuhan
];

class Layout extends StatefulWidget {
  const Layout({Key? key}) : super(key: key);

  @override
  State<Layout> createState() => _LayoutState();
}

class _LayoutState extends State<Layout> with TickerProviderStateMixin {
  int activeTab = 0;

  late final AnimationController _controller = AnimationController(
    vsync: this,
    duration: Duration(milliseconds: 500),
  );

  late final Animation<double> _animation = CurvedAnimation(
    parent: _controller,
    curve: Curves.fastOutSlowIn,
  );

  @override
  void initState() {
    _controller.forward();
    super.initState();
  }

  @override
  void dispose() {
    _controller.stop();
    _controller.dispose();
    super.dispose();
  }

  Widget buildAnimateScreen(Widget screen) {
    return FadeTransition(
      opacity: _animation,
      child: screen,
    );
  }

  void onScreenChanged(int index) {
    _controller.reset();
    setState(() {
      activeTab = index;
    });
    _controller.forward();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: tertiaryColor,
      body: buildProjectLayoutBody(),
      bottomNavigationBar: Container(
        height: 60.0,
        width: double.infinity,
        decoration: BoxDecoration(
          color: Colors.white,
          boxShadow: [
            BoxShadow(
              color: Colors.black87.withOpacity(0.1),
              blurRadius: 1,
              spreadRadius: 1,
              offset: Offset(1, 1),
            ),
          ],
        ),
        child: Padding(
          padding: EdgeInsets.only(
            left: 25,
            right: 25,
            bottom: 2,
          ),
        ),
      ),
    );
  }

  Widget buildProjectLayoutBody() {
    return IndexedStack(
      index: activeTab,
      children: List.generate(
        bottomNavigationBarItems.length,
        (index) => buildAnimateScreen(
          bottomNavigationBarItems[index]['view'],
        ),
      ),
    );
  }
}
