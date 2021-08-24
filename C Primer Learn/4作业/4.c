#include<stdio.h>
int main()
{
	int i,a[5],y;
	printf("input array:");
	for(i=0;i<5;i++)
	{
		scanf("%d",&a[i]);
	}
	printf("input number:");
	scanf("%d",&y);
	for(i=0;i<5;i++)
	{
		if(y==a[i])
		{
			printf("i=%d",i);
			break;
		}
		else
		{
			if(i==4)
				printf("error");
		}
	}
	return 0;
}


