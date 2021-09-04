/*
    编写一个学生类
    1.输出每个学生的姓名，学号，成绩
    2.统计并输出学生的总人数，总成绩，平均成绩，最高成绩，最低成绩
*/
#include<iostream>
#include<cstring>
using namespace std;
class Student
{
    private:
        static int total;
        static int num;
        static int aver;
 


    public:
        char name[5];
        int StudentID;
        int score;
        static int max;
        static int min;

        Student();
        void Add();
        int AverScore();
        void MaxScore();
        void MinScore();
        int Fprint();
        void Print();
};
Student::Student()
{
    total++;

}
void Student::Print()
{
    cout << "My name is:  " << name << endl;
    cout << "My StudentID is: " << StudentID << endl;
    cout << "My score is: " << score << endl;
    cout << "------------------------------------" << endl;

}
void Student::MinScore()
{
    if(min>score)
        min = score;
}
void Student::MaxScore()
{
   
    if(max<score)
        max = score;
    
}
int Student::AverScore()
{
    int x;
    x = num / total;
    return x;
}
void Student::Add()
{
    num = num + score;
}
int Student::Fprint()
{

    return num;
}
int Student::total = 0;
int Student::num = 0;
int Student::max = 0;
int Student::min = 9999;
int main()
{
    Student a1, a2;
    strcpy(a1.name, "XB");
    a1.score = 80;
    a1.StudentID = 20211031;
    a1.Add();
    a1.MaxScore();
    a1.MinScore();
    a1.Print();

    strcpy(a2.name, "ZZ");
    a2.score = 90;
    a2.StudentID = 20201031;
    a2.Add();
    a2.MaxScore();
    a2.MinScore();
    a2.Print();
    
    cout << "The All student score is:    " <<a1.Fprint()<< endl;
    cout << "Aver Score is:   " << a1.AverScore()<<endl;
    cout << "The max score is:  " << Student::max << endl;
    cout << "The min score is:    " << Student::min << endl;

    return 0;
}
