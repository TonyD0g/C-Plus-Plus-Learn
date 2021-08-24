#include<stdio.h>
int main()
{
	int z,c=0,x;
	char a[100];
	int len(char a[100]);
	gets(a);
	z=len(a);
/*	for(x=0;a[x]!=0;x++)
	{
		if(a[x]==' ')
		{
			c=c+1;
		}
	}
	*/
		z=z-c;
		printf("%d\n",z);
		return 0;
}
int len(char a[100])
{
	int y,x;
	y=strlen(a);
	return y;
}

