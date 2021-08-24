#include<stdio.h>
int main()
{
	char a[6][20],b[6][20];
	int i=0,x;
	for(i=0;i<6;i++)
	{
		gets(a[i]);
	}
		for(x=0;x<5;x++)
		{
			if(strcmp(a[i],a[x])>0)
			{
				strcpy(b,a[i]);
				strcpy(a[i],a[x]);
				strcpy(a[i],b);
			}
		}
		for(i=0;i<6;i++)
		{
			puts(a[i]);
		}
	return 0;
}
