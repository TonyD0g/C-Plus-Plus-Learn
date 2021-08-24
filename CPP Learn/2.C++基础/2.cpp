/*
	有一个含有4个元素的整数数组，从键盘上输入4个整数给数组，并将此数组的数值存放到磁盘文件
	shuzu.txt
*/
#include<iostream>
using namespace std;
int main()
{
	printf("请输入4个数字\n");
	int a[4],i;
	for(i=0;i<4;i++)
		cin>>a[i];
	cout<<"------------------------------------"<<endl;
	for(i=0;i<4;i++)
		cout<<a[i]<<endl;
	
	FILE *fp;
	if((fp=fopen("shuzu.txt","wb"))==NULL)
	{
		cout<<"This File is not exit!"<<endl;
		exit(0);
	}
	for(i=0;i<4;i++)//文件读写
		fprintf(fp,"%d\n",a[i]);
	fclose(fp);
	return 0;
}
