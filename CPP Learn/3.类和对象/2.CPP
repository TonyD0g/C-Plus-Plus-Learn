/*
	声明一个datatype类，能处理包含字符型，整形和浮点型三种类型的数据
	给出其构造函数
*/
#include<iostream>
using namespace std;
class datatype {
	public:
		datatype();
		int tackle(int a);
		char tackle(char a);
		float tackle(float a);

};
datatype::datatype() {
	cout << "处理包含字符型，整形和浮点型三种类型的数据" << endl;
}
int datatype::tackle(int a) {
	a = a + 10;
	return a;
}
char datatype::tackle(char a) {
//	int b;
	a = int(a) + 10;
	return a;
}
float datatype::tackle(float a) {
	a = a + 10.1;
	return a;
}
int main() {
	datatype data;
	cout << "int类型处理：\t" << data.tackle(10) << endl;
	cout << "char类型处理：\t" << data.tackle(char('A')) << endl;
	cout << "float类型处理：\t" << data.tackle(float(10.1)) << endl;
	return 0;
}
/*
	书上的代码：(利用外部导入参数，重载构造函数）
	#include<stdafx.h>
	class datatype
	{
		char x;
		int y;
		double z;
	public:
		datatype(char x1);
		datatype(int y);
		datatype(double z1);

	};

	datatype::datatype(char x1)
	{
		x=x1;
	}
	datatype::datatype(int y)
	{
		y=y1;
	}
	datatype::datatype(double z1):z(z1)
	{

	}
	int _tmain(int argc,_TCHAR* argv[1])
	{
		return 0;
	}

*/
