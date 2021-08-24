#include<stdio.h>
#include<string.h>
void move(char one,char two);
void h(int n,char o,char t,char th);
void main()
{
	int m;
	scanf("%d",&m);
	h(m,'A','B','C');
}
	void move(char one,char two)
	{
		printf("%c-->%c\n",one,two);
	}
	void h(int n,char o,char t,char th)
	{
		if(n==1)
			move(o,th);
			else
			{
				h(n-1,o,th,t);
				move(o,th);
				h(n-1,t,o,th);
			}
	}


