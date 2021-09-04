/*
	下面是一个类的测试程序，设计出能使用如下测试程序的类
	int main()
	{
		A x;
		x.initx(400,500);
		x.print();
		return 0;
	}
*/
#include<iostream>
using namespace std;
class A
{
	private:
		int money;
		int finallymoney;	
	public:
		void initx(int x1,int x2);
		void print();
};
void A::initx(int x1,int x2)
{
	money = x1;
	finallymoney = x2;
}
void A::print()
{
	cout<<"money has been changed"<<endl;
	cout<<money<<"\t=>\t"<<finallymoney<<endl;
}
int main()
{	
	A x;
	x.initx(400,500);
	x.print();
	return 0;
}
