#include<stdio.h>
int main()
{
	int i=0,x;
	for(x=1;x>=1&&x<=100;x=x+1)
	{
		if(x%7==0)
		{
			printf("%d ",x);
			i=i+1;
			if(i==5)
			{
				printf("\n");
				i=0;
			}
		}
	}
}
