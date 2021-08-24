/*
	编写输入，输出2个朋友数据的通讯录程序
	每个朋友的数据包括姓名，地址，电话。
*/

#include<iostream>
using namespace std;
typedef struct Phone
{
	char name[4];
	char address[10];
	int PhoneNum;
	
}Phone;
Phone User;
int main()
{
	int i=2;
	while(i--)
	{
		
	cout<<"Welcome to the PhoneProgram!\n"<<endl;
	cout<<"Please input your name"<<endl;
	cin>>User.name;
	cout<<"Please input your address"<<endl;
	cin>>User.address;
	cout<<"Please input your PhoneNum"<<endl;
	cin>>User.PhoneNum;
	cout<<"name is:"<<User.name<<"\taddress is:"<<User.address <<"\tPhoneNum is:"<<User.PhoneNum<<"\n----------------"<<endl;
	}
	return 0;
}
