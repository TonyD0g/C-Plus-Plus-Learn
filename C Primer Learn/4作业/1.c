#include<stdio.h>
int main()
{
	int i=0,x,score[10];
	
		
		for(i=0;i<=9;i++)
		{	
			scanf("%d",&x);
			score[i]=x;
		}
		for(i=9;i>=0;i--)
		{
			
			printf("%d ",score[i]);
		}
	return 0;

}
