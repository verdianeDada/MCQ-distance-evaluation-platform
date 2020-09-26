# MCQ Distance Evalution Platform

<p align="center">
  <img  alt="Demo Video" src="https://github.com/verdianeDada/MCQ-distance-evaluation-platform/blob/master/Demo_video.gif">
</p>

## Introduction
This is an evaluation web app initially designed for a computer science department of the HTTTC Bambili, Cameroon.

Each registered teacher can set MCQ test which will be accessible by students at a particular time, scheduled by an algorithm. and after the the test paper time is passed, the teacher can get the students' results in a PDF file. and on the other side, students can download the correction

## Technologies
This project has been created using:
- ```Laravel``` version: 5.4
- ```VueJS``` version: 2.6.4
- ```Bootstrap``` version: 4.3.1

## Installation 
To get exactly the same result, install
- ```XAMMP``` version: 7.4.2
- ```Nodejs```version: 10.16.0
- ```Composer```version: 5.1.0.0

## Setup
Create a database named **"distance_evaluation"** and fill it using the file **"./distance_evaluation_DataBase.sql"**

Run the following commands to install Node and Laravel dependencies:
```sh
$ npm instal
$ composer install
```
Start MySql server and launch the server by typing the following command
```sh
$ php artisan serve
```
Verify the deployment by navigating in your favorite browser (Chrome is mine :-) in the following adress:

```sh
127.0.0.1:8000
```
You can use the following credentials to be identified as a teacher administrator 
***Phone: 672121212 Password "dada"***
or the following to be identified as a student administrator 
***Phone: 673131313 Password "madom"***

## Enjoy now! :-)


