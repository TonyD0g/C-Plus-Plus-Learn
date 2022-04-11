//编写程序，设计一个学术类student,包括姓名和3门课成绩,利用重载运算符"+" 将
//所有学生的成绩相加并放在一个对象中,再对该对象求各门课程的平均分.

#include<iostream>
#include<iomanip>
#include<string.h>
using namespace std;
class student
{
    char name[10];
    int deg1, deg2, deg3;

    public:
            student(){}
            student(char na[],int d1,int d2,int d3)
            {
                strcpy(name, na);
                deg1 = d1;
                deg2 = d2;
                deg3 = d3;
            }
            friend student operator + (student s1,student s2)
            {
				static student st;
				st.deg1=s1.deg1+s2.deg1;
				st.deg2=s1.deg2+s2.deg2;
				st.deg3=s1.deg3+s2.deg3;
				return st;
			}
            void disp()
            {
                cout << setw(10) << name << setw(5) << deg1 << setw(5) << deg3 << endl;
            }
            friend void avg(student &s ,int n)
            {
                cout << setw(10) << "The average is " << setw(5) << s.deg1 / n << setw(5) << s.deg2 / n << setw(5) << s.deg3 / n << endl;
            }
};

int main()
{
    student s1("Li", 89, 77, 90), s2("Zhen", 71, 78, 92);
    student s3("Zhao", 56, 67, 90), s4("Qian", 39, 72, 70),s;
    cout << "OutPut :" << endl;
    s1.disp();
    s2.disp();
    s3.disp();
    s4.disp();
    s = s1 + s2 + s3 + s4;
    avg(s, 4);
    return 0;
}
