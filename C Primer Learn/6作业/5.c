#include<stdio.h>
int loop(int a,int b);
int ji(int num);
void main()
{
	int a,b,t;
	scanf("%d %d",&a,&b);
	if(a>b)
	{
		t=a;
		a=b;
		b=t;
	}
	loop(a,b);
}
int loop(int a,int b)
{
	int i,sum=0;
	for(i=a;i<=b;i++)
	{
		ji(i);
		if(ji(i)==i)
			printf("%d\n",i);
	}
	return 0;
}
int ji(int num)
{
	int sum=0;
	while(num)
	{
		sum=sum*10+(num%10);
		num/=10;
	}
	return sum;
}

