#include<stdio.h>
/*
	定义一个结构体student,包括学生的学号，姓名，性别
	出生日期。
	出生日期要求包括年月日。
	编写一个程序输出一个学生的所有信息
*/
struct Brithday
{
    int year;
    int moon;
    int day; /* data */
};

struct Student
{
    char id[10];
    char sex[3];
    struct Brithday Brithdays;
    /* data */
}Students={"2000101","男",{2000,10,1}};




int main()
{
    printf("id为%s	性别为：%s	出生年月日：%d.%d.%d\n",Students.id,Students.sex,Students.Brithdays.year,Students.Brithdays.moon,Students.Brithdays.day);
}
