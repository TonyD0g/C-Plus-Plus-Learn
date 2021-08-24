#include<stdio.h>
#include<string.h>
#define max_len 10
#define N 150

void sortstring(char *ptr[],int n)
{
	int j,k;
	char *t=NULL;
	for(j=0;j<n-1;j++)
	{
		for(k=j+1;k<n;k++)
		{
			if(strcmp(ptr[k],ptr[j])<0)
			{
				t=ptr[j];
				ptr[j]=ptr[k];
				ptr[k]=t;
			}
		}
	}
}
int main()
{
	int i,n;
	char name[N][max_len];
	char *pstr[N];
	void sortstring(char *ptr[],int n);
	printf("How many countries? ");
	scanf("%d",&n);
	getchar();
	printf("Input their names: ");
	for(i=0;i<n;i++)
	{
		gets(name[i]);
		pstr[i]=name[i];
	}
	sortstring(pstr,n);
	printf("Sorted results: \n");
	for(i=0;i<n;i++)
	{
		puts(pstr[i]);
	}
	return 0;
}


