/*
	编写计算面积的函数，分别计算圆，矩形，梯形和三角形等图形的面积。
*/
#include<iostream>
#include<math.h>
#define PI	3.14
using namespace std;
double area(double radius=0)//圆
{
	double x;
	x = PI * radius *radius;
	return x;
}
double area(double a,double b)//矩形
{
	double x;
	x = a * b;
	return x;
}
double area(double a,double b,double h)//梯形
{
	double x;
	x = ((a + b) * h)/2;
	return x;
}
double area(double a,double b,double c,int)//三角形面积,int只起标识的作用
{
	double x,p;	//用海伦公式
	p =(a+b+c)/2;
	x=sqrt(p*(p-a)*(p-b)*(p-c));
	return x;
}
int main()
{
	cout<<"圆"<<area(3)<<endl;
	cout<<"矩形"<<area(3,4)<<endl;
	cout<<"梯形"<<area(3,4,5)<<endl;
	cout<<"三角形"<<area(3,4,5,1)<<endl;
	return 0;
}
