/*
输入一个字符，如果该字符是英文字母，则打印该英文字母的ASCII码，要求可以输入任意字符。
*/

#include<iostream>
using namespace std;
int main()
{
	char Achar;
	cout<<"Please input a char!\n"<<endl;
	//或者不加命名空间，则句式应改写为：std::cout<<"Please input a char!\n"<<std::endl;
	while(1)
	{	cin>>Achar;
		if((Achar>=65&&Achar<=90)||(Achar>=97&&Achar<=122))
		
			cout<<"This is a ZiMu,and The char's ASCII is: "<<int(Achar)<<endl;
			//或使用C语言的printf("%c",Achar);
		else
		 cout<<"This is not a ZiMu"<<endl;
		}
	return 0;
}
