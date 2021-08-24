/*
	编写程序，创建当前目录下磁盘文件book.dat，将书中的信息：书名，作者，出版社，价格等保存到该文件
	然后打开创建的book.dat文件，从中读取并显示任意一本书信息
*/
#include<iostream>
#include<fstream>
using namespace std;
int main()
{
	fstream fp;
	fp.open("book.dat",ios::out);//文件写操作
	fp<<"C++"<<" "<<"郭伟"<<" "<<"清华大学"<<" "<<50<<endl;
	fp<<"C"<<" "<<"小明"<<" "<<"北京大学"<<" "<<30<<endl;
	fp.close();
	
	fp.open("book.dat");//文件读操作
	char title[10],author[10],publish[10];
	int price;
	
	cout<<"书名\t"<<"作者\t"<<"出版社\t"<<"价格\t"<<endl;
	fp>>title;
	while(!fp.eof())//不断读写
	{
		fp>>author>>publish>>price;
		cout<<title<<"\t"<<author<<"\t"<<publish<<"\t"<<price<<"\t"<<endl;
		fp>>title;
	}
	
	fp.close();
	return 0;
}
