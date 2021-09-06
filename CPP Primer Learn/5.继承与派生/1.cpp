/*
    编写程序声明一个哺乳动物Mammal类，再由此派生出Dog，要求类中都
    必须包含输出信息的构造函数与析构函数。声明一个Dog类的对象，
    使用程序观察基类和派生类的构造函数和析构函数的调用顺序
*/

#include<iostream>
using namespace std;
class Mammal
{
    public:
        Mammal();
        ~Mammal();
};
Mammal::Mammal()
{
    cout << "Mammal is creating!" << endl;
}
Mammal::~Mammal()
{
    cout << "Mammal is dying!" << endl;
}
class Dog:public Mammal
{
    public:
        void DogShout();
        void DogWalk();
        Dog();
        ~Dog();
};
Dog::Dog()
{
    cout<<"Dog is creating!"<<endl;
}
Dog::~Dog()
{
    cout << "Dog is dying!" << endl;
}
void Dog::DogShout()
{
    cout << "Dog is Shouting!" << endl;
}
void Dog::DogWalk()
{
    cout << "Dog is quickly walk!" << endl;
}
int main()
{
    Dog dog1;
    
    dog1.DogWalk();
    dog1.DogShout();
    return 0;
}
