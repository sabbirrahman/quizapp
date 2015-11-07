<?php

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table("questions")->delete();
        
        Question::create(['quiz_id' => 1, 'question' => 'A program that can copy itself and infect a computer without the permission or knowledge of the owner is called what?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of these is a correct format of IP address?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which was the first web browser?']);
        Question::create(['quiz_id' => 1, 'question' => 'It is a small piece of text stored on a user\'s computer by a web browser for maintaining the state. What we are talking about?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of these is a correct format of Email address?']);
        Question::create(['quiz_id' => 1, 'question' => 'What does HTTP stands for?']);
        Question::create(['quiz_id' => 1, 'question' => 'In computers, what is the smallest and basic unit of information storage?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which company is nicknamed "Big Blue"?']);
        Question::create(['quiz_id' => 1, 'question' => 'What is JVM?']);
        Question::create(['quiz_id' => 1, 'question' => 'What is Windows XP?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of the following is responsible for the management and coordination of activities and the sharing of the resources of the computer?']);
        Question::create(['quiz_id' => 1, 'question' => 'WAV file format is associated with what type of files?']);
        Question::create(['quiz_id' => 1, 'question' => 'What is a Compiler?']);
        Question::create(['quiz_id' => 1, 'question' => 'Machine language is also known as']);
        Question::create(['quiz_id' => 1, 'question' => 'What does FTP stand for?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which company acquired Sun Microsystems on January 27, 2010?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which was the first ever web server software?']);
        Question::create(['quiz_id' => 1, 'question' => 'What does BCC means in EMail?']);
        Question::create(['quiz_id' => 1, 'question' => 'MS-Word is an example of']);
        Question::create(['quiz_id' => 1, 'question' => 'Who is known as the father of the Java programming language?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which software application is used for accessing sites or information on a network (as the World Wide Web)?']);
        Question::create(['quiz_id' => 1, 'question' => 'What are the two broad categories of software?']);
        Question::create(['quiz_id' => 1, 'question' => 'One kilobyte contains how many bytes?']);
        Question::create(['quiz_id' => 1, 'question' => 'In computers, a collection of row data is known as what?']);
        Question::create(['quiz_id' => 1, 'question' => 'Who Owns the Internet?']);
        Question::create(['quiz_id' => 1, 'question' => 'What is the shortcut key of printing a document for computer having windows?']);
        Question::create(['quiz_id' => 1, 'question' => 'It is defined as the period of time that a unique user interacts with a Web application. What we are talking about?']);
        Question::create(['quiz_id' => 1, 'question' => 'Java is a']);
        Question::create(['quiz_id' => 1, 'question' => 'In computers, \'.TMP\' extension refers usually to what kind of file?']);
        Question::create(['quiz_id' => 1, 'question' => 'The way of manipulating data into information is called']);
        Question::create(['quiz_id' => 1, 'question' => 'What Does BIOS Stand For?']);
        Question::create(['quiz_id' => 1, 'question' => 'Abbreviate \'LAN\' in computer networks']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of the following performs modulation and demodulation?']);
        Question::create(['quiz_id' => 1, 'question' => 'In windows computers, MPEG extension refers to what kind of file?']);
        Question::create(['quiz_id' => 1, 'question' => 'Memory management is a feature of']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of the following is not a storage device?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of these is the first web-based e-mail service?']);
        Question::create(['quiz_id' => 1, 'question' => 'The Specially designed computers to perform very complex calculations extremely rapidly are called as']);
        Question::create(['quiz_id' => 1, 'question' => 'A bus is a / an']);
        Question::create(['quiz_id' => 1, 'question' => 'How many layers are described in networking?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of the following is not a web server?']);
        Question::create(['quiz_id' => 1, 'question' => 'What was the first general-purpose electronic computer?']);
        Question::create(['quiz_id' => 1, 'question' => 'What is CGI?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which of the following is not a database?']);
        Question::create(['quiz_id' => 1, 'question' => 'The term \'Pentium\' is related to what?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which supercomputer is developed by the Indian Scientists?']);
        Question::create(['quiz_id' => 1, 'question' => 'Check the odd term out']);
        Question::create(['quiz_id' => 1, 'question' => 'What is the final value of x when the code int x; for(x=0; x<10; x++) {} is run?']);
        Question::create(['quiz_id' => 1, 'question' => 'When does the code block following while(x<100) execute?']);
        Question::create(['quiz_id' => 1, 'question' => 'Which is not a loop structure?']);

    	Question::create(['question' => 'A for?', 'quiz_id' => 2]);
    	Question::create(['question' => 'B for?', 'quiz_id' => 4]);
    	Question::create(['question' => 'C for?', 'quiz_id' => 2]);
    	Question::create(['question' => 'D for?', 'quiz_id' => 3]);
    	Question::create(['question' => 'E for?', 'quiz_id' => 3]);
    	Question::create(['question' => 'F for?', 'quiz_id' => 4]);
    }
}
