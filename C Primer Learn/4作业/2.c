#include<stdio.h>
int main()
{
	int x,i,score[5];
	float y=0,s=0,ave;
	printf("input numbers:");
	for(x=1;x<=5;x++)
	{
		
			scanf("%d",&i);
			score[x-1]=i;
		
	}
	for(x=5;x>=1;x--)
	{	
		y=score[x-1];
		s=s+y;
		
		
	}
	ave=s/5;
	printf("ave=%.2f\n",ave);
	return 0;

}
