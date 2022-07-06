#include<stdio.h>
#include<string.h>

//加密
int encrypt(char *text,char *result,char *k)
{
    int l,i,j=0,z=0;
    for(l=0;text[l]!='\0';l++);
    for(i=0;i<l;i++)
    {
        result[z]=(text[i]-'a'+k[j]-'a')%26+'a';
        j++;
        z++;
    }
    return 0;
}

//解密
int decrypt(char *text,char *result,char *k)
{
    int l,i,j=0,z=0;
    for(l=0;text[l]!='\0';l++);
    for(i=0;i<l;i++)
    {
        result[z]=(text[i]-k[j]+26)%26+'a';
        j++;
        z++;
    }
    return 0;
}

int main()
{
    char text[50]="";
    char result[50]="";
    char middle[50]="";
    char k[50]="";

    printf("输入明文：\n");
    scanf("%[^\n]",text);
    
    printf("请输入密钥k：\n");
    scanf("%s",k);
    /**加密**/
    encrypt(text,result,k);
    printf("明文%s的密文为:%s\n",text,result);
    strcpy(middle,result);
    strcpy(result,text);
    strcpy(text,middle);
	
    /**解密**/
    decrypt(text,result,k);
    printf("密文%s的明文为:%s\n",text,result);
    return 0;
}
