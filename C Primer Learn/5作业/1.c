#include<stdio.h>
void main()
{
	int x=0,y=0,z=0,sum=0;
	char a[1],b[80];
	printf("Input a character:");
	gets(a);
	printf("Input a string:");
	gets(b);
	for(y=0;b[y]!='\0';y++)
	{
		if(b[y]==a[0])
		{	
			
			if(sum<y)
			{
				sum=y;
			}	
		}
	}
	if(sum==0)
	{
		printf("Not Found");
	}
	else
		if(sum!=0)
	printf("index=%d",sum);
}
