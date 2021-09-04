/*
    编写一个学生类，学生信息包括姓名，学号，年龄，性别和成绩;
    统计学生的总人数及总成绩，并输出。
*/
#include<iostream>
#include<cstring>
using namespace std;
class Student
{
    private:
       static int  i;
       static int num;

   public:
       char name[5];
       int studentID;
       int age;
       char sex;
       int score;
       Student();
       int scorefuncition();
};
int Student::scorefuncition()
{
    num = num + score;
    cout << "Now,All the student score is:    " << num<<endl;
}
Student::Student()
{
    i++;
    
    cout << "Now,the student number is:   " << i<<endl;
}
int Student::i = 0;
int Student::num = 0;
int main()
{
    Student a1,a2;
    a1.age = 18;
  //  a1.name = "XM\0";
    strcpy(a1.name, "XM");
    a1.score = 80;
    a1.sex = 'M';
    a1.studentID = 20211031;
    a1.scorefuncition();

    a2.age = 18;
   // a2.name = "wm";
    strcpy(a2.name, "wm");
    a2.score = 70;
    a2.sex = 'N';
    a2.studentID = 20211030;
    a2.scorefuncition();


    return 0;
}