/*
	已知一个student结构体，请编写主函数，为student结构体开辟动态存储空间并赋值，
	然后输出student的这些值.
*/
#include<iostream>
#include<string.h>
using namespace std;
struct student
{
	char name[10];
	int num;
	char sex;
};
int main()
{
	struct student *Student;//创建Student变量
//C的方法：	Student = (struct student*)malloc(sizeof(struct student));
	Student = new	struct student;//C++的方法
	strcpy(Student->name,"XiaoMin");
	Student->num	=666;
	Student->sex	='M';
	printf("姓名：%s	学号：%d	性别：%c\n",Student->name,Student->num,Student->sex);
//C的方法：free(Student);
	delete Student;//C++的方法
	return 0;
}
