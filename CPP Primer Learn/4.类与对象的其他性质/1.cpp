/*
	建立一个类，该类具有const和非const成员函数.
	创建这个类的const和非const对象，
	并用不同类型的对象调用不同类型的成员函数。
	
*/
#include<iostream>
using namespace std;
class Classa
{
	public:
		int a;
		int b;
		int sub()const;
		int add();
		Classa();
};
Classa::Classa()
{
	a = 1;
	b = 1;
}

int Classa::add()
{
	int x;
	x = a + b;
	return x;
}
int Classa::sub()const
{
	int x;
	x = a - b;
	return x;
}
int main()
{
	Classa first;
	Classa	const  second;
	cout << "add:	"<<first.add() << endl;
	cout <<"sub:	"<< second.sub() << endl;
	return 0;
}
