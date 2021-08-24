#include<stdio.h>
#define N 10//printf
int main()
{
	int n,i;
	struct staff
	{
		char name[10];
		float jb;
		float fb;
		float zc;
	}staff1[N];
	float salary[100];
	printf("n=");
	scanf("%d",&n);
	
	for(i=0;i<n;i++)
	{
		scanf("%s %f %f %f",staff1[i].name,&staff1[i].jb,&staff1[i].fb,&staff1[i].zc);
		salary[i]=staff1[i].jb+staff1[i].fb-staff1[i].zc;
	}
	for(i=0;i<n;i++)
		{
			printf("%5s,Salary is:%7.2f\n",staff1[i].name,salary[i]);		
		}
		return 0;
}

