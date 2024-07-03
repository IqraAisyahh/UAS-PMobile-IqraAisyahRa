// import 'package:academic_flutter/views/login.dart';
// import 'package:flutter/material.dart';
// import 'package:academic_flutter/constants/colors.dart';
// import 'package:academic_flutter/constants/images.dart';

// class WelcomeView extends StatelessWidget {
//   const WelcomeView({super.key});

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       body: Material(
//         color: tertiaryColor,
//         child: Column(
//           children: [
//             Expanded(
//               child: Container(
//                 width: double.infinity,
//                 decoration: BoxDecoration(
//                   color: primaryColor,
//                   borderRadius: BorderRadius.only(
//                     bottomRight: Radius.circular(50.0),
//                   ),
//                 ),
//                 child: Column(
//                   mainAxisAlignment: MainAxisAlignment.center,
//                   children: [
//                     Expanded(
//                       child: Image.asset(welcomeImage),
//                     ),
//                   ],
//                 ),
//               ),
//             ),
//             Expanded(
//               child: Container(
//                 color: primaryColor,
//                 child: Container(
//                   width: double.infinity,
//                   decoration: BoxDecoration(
//                     color: tertiaryColor,
//                     borderRadius: BorderRadius.only(
//                       topLeft: Radius.circular(50),
//                     ),
//                   ),
//                   child: Padding(
//                     padding: const EdgeInsets.all(15.0),
//                     child: Column(
//                       children: [
//                         Spacer(),
//                         Text(
//                           "Learning is Fun",
//                           style: TextStyle(
//                             fontSize: 28,
//                             fontWeight: FontWeight.w500,
//                           ),
//                         ),
//                         Spacer(),
//                         Text(
//                           "Learn with pleasure with \nus wherever you are!",
//                           style: TextStyle(
//                             fontSize: 16,
//                             fontWeight: FontWeight.w500,
//                             color: Colors.black87,
//                             height: 1.5,
//                             wordSpacing: 2.5,
//                           ),
//                           textAlign: TextAlign.center,
//                         ),
//                         Spacer(flex: 3),
//                         ElevatedButton(
//                           style: ElevatedButton.styleFrom(
//                             backgroundColor: primaryColor,
//                             padding: EdgeInsets.symmetric(
//                               horizontal: 30,
//                               vertical: 10,
//                             ),
//                             shape: RoundedRectangleBorder(
//                               borderRadius: BorderRadius.circular(20),
//                             ),
//                           ),
//                           onPressed: () {
//                             Navigator.push(
//                               context, 
//                               MaterialPageRoute(
//                               builder: (BuildContext) => LoginView(),
//                               ),
//                             );
//                           },
//                           child: Row(
//                             mainAxisSize: MainAxisSize.min,
//                             children: [
//                               Text(
//                                 "Get Started",
//                                 style: TextStyle(
//                                   fontSize: 16.0,
//                                   color: Colors.white,
//                                   fontWeight: FontWeight.bold,
//                                 ),
//                               ),
//                               SizedBox(width: 5.0),
//                               Icon(
//                                 Icons.chevron_right_rounded,
//                                 color: Colors.white,
//                                 size: 20.0,
//                               ),
//                             ],
//                           ),
//                         ),
//                       ],
//                     ),
//                   ),
//                 ),
//               ),
//             ),
//           ],
//         ),
//       ),
//     );
//   }
// }
