import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget{
  @override
  Widget build(BuildContext context){
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: Text('Andi Adi Saputra'),
        ),
        body: Center(
          child: Text(
            'Hallo Flutter',
            style: TextStyle(fontSize: 30),
          ),
        ),
      ),
    );
  }
}