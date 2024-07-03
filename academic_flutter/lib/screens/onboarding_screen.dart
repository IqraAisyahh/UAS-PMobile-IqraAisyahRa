// ignore_for_file: camel_case_types, prefer_typing_uninitialized_variables

import 'package:flutter/material.dart';

class OnboardingScreen extends StatefulWidget {
const OnboardingScreen({Key? key}) : super(key: key);

@override
State<OnboardingScreen> createState() => _OnboardingScreenState();
}

class _OnboardingScreenState extends State<OnboardingScreen> {
@override
Widget build(BuildContext context) {
return Scaffold(
appBar: AppBar(
title: const Text("Dashboard"),
actions: const [],
),
body: SingleChildScrollView(
child: Container(
padding: const EdgeInsets.all(10.0),
child: Column(
children: [],
),
),
),
);
}
}
