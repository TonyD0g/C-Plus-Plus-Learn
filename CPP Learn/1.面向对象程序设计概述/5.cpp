/*
	将一个数组中的值按照逆序重新存放
	例如原来顺序为5,4,3,2,1
	更改为1,2,3,4,5
	
*/
#include<iostream>
using namespace std;
int main()
{
	int a[5],i=5,x=0,t;
	cout<<"Please input 5 num"<<endl;
	while(i--)
	cin>>a[x++];

	cout<<endl;
	
	i=0;//核心算法
	while(i!=(5/2))
	{
		t=a[i];
		a[i]=a[4-i];
		a[4-i]=t;
		i++;
	}
	
	cout<<endl;
	i=5;x=0;
	while(i--)
	cout<<a[x++]<<endl;
	return 0;
}
