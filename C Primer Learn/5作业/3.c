#include<stdio.h>
int main()
{
	char a[8];
	int i,count=0;
	printf("Input a string:");
	gets(a);
	for(i=0;a[i]!='\0';i++)
	{
		if(a[i]>='A'&&a[i]<='Z')
			if(a[i]!='A'&&a[i]!='E'&&a[i]!='I'&&a[i]!='O'&&a[i]!='U')
			{
				count=count+1;
			}
	}
	printf("count=%d\n",count);
	return 0;
}
