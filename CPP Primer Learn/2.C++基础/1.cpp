/*
	编写3个重载函数max(),分别求两个整数，实数和双精度整数中最大的数，并在主函数中测试它。
*/
#include<iostream>
using namespace std;
int max(int x,int y)
{
	if(x>y)
		return x;
	else
		return y;
}

float max(float x,float y)
{
	if(x>y)
		return x;
	else
		return y;
}

double max(double x,double y)
{
	if(x>y)
		return x;
	else
		return y;
}
int main()
{
	cout<<"The max num is:"<<max(3,4)<<endl;
	cout<<"The max num is:"<<max(4.0,5.1)<<endl;
	cout<<"The max num is:"<<max(5.10,9.111)<<endl;
}
