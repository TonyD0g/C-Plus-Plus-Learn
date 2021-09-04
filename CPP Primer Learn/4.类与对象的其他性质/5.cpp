/*
    利用静态的概念，编写一个小狗类，统计并输出每个小狗的重量，
    小狗的总数量及总重量。
*/

#include<iostream>
#include<cstring>
using namespace std;
class Dog
{
    private:
        static int total;
        static float totalHight;
        char Name[5];

    public:
        Dog(char *name,float hight);//名字，重量
        void PrintDog();
};
Dog::Dog(char *name,float hight)
{
    strcpy(Name, name);
    cout << "I am A dog,and my name is:   " << Name <<"     ,My hight is: "<<hight<< endl;
    total = total + 1;
    totalHight = totalHight + hight;
}
void Dog::PrintDog()
{
    cout << "All the Dog total is:    " << total << endl;
    cout << "The totalHight is:   " << totalHight << endl;

}
int Dog::total = 0;
float Dog::totalHight = 0;
int main()
{
    Dog dog1((char*)"SW",30), dog2((char*)"FK",20);
    dog1.PrintDog();

    return 0;
}
//C++ forbids converting a string constant to 'char*'