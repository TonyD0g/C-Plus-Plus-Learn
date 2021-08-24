# sort

* sort实际上是快速排序，平均时间复杂度 O(n*log(n))，最坏是O(n^2)

* 排序算法要求随机存取迭代器的支持，所以list不能使用排序算法，要使用list::sort

  ```c++
  #include <iostream>
  #include <algorithm>
  #include <vector>
  using namespace std;
  
  struct Rule1 {
      bool operator()(const int& a, const int& b) {
          return (a%10 < b%10);
      }
  };
  
  int main() {
  
      vector<int> arr{21,2,23,40,25,6,77,25,9,23};
  
      // 默认是从小到大排序
      sort(arr.begin(), arr.end());
      for_each(arr.begin(), arr.end(), [](const int &n){cout<<n<<" ";});
      cout<<endl; // 2 6 9 21 23 23 25 25 40 77
  
      // 从大到小排序
      sort(arr.begin(), arr.end(), greater<int>());
      for_each(arr.begin(), arr.end(), [](const int &n){cout<<n<<" ";});
      cout<<endl; // 77 40 25 25 23 23 21 9 6 2
  
      // 按个位从小到大排序
      sort(arr.begin(), arr.end(), Rule1());
      for_each(arr.begin(), arr.end(), [](const int &n){cout<<n<<" ";});
      cout<<endl; // 40 21 2 23 23 25 25 6 77 9 
  
      return 0;
  }
  ```
```c++
#include <iostream>
#include <algorithm>
#include <string>
#include <vector>
using namespace std;

struct Student {
    string name;
    int id;
    double gpa;
};

struct Rule1 {
    bool operator()(const Student& a, const Student& b) const{
        return (a.name<b.name);
    }
};

struct Rule2 {
    bool operator()(const Student& a, const Student& b) const{
        return (a.id<b.id);
    }
};

struct Rule3 {
    bool operator()(const Student& a, const Student& b) const{
        return (a.gpa>b.gpa);
    }
};

int main() {

    vector<Student> students{{"Jack",112,3.4},{"Mary",102,3.8},{"Mary",117,3.9},
                          {"Ala",333,3.5},{"Zero",101,4.0}};

    // 姓名从小到大排序
    sort(students.begin(), students.end(), Rule1());
    for_each(students.begin(), students.end(), [](const Student &stu){cout<<"("<<stu.name<<","<<stu.id<<","<<stu.gpa<<") ";});
    cout<<endl; // (Ala,333,3.5) (Jack,112,3.4) (Mary,102,3.8) (Mary,117,3.9) (Zero,101,4)

    // id从小到大排序
    sort(students.begin(), students.end(), Rule2());
    for_each(students.begin(), students.end(), [](const Student &stu){cout<<"("<<stu.name<<","<<stu.id<<","<<stu.gpa<<") ";});
    cout<<endl; // (Zero,101,4) (Mary,102,3.8) (Jack,112,3.4) (Mary,117,3.9) (Ala,333,3.5)

    // gpa从大到小排序
    sort(students.begin(), students.end(), Rule3());
    for_each(students.begin(), students.end(), [](const Student &stu){cout<<"("<<stu.name<<","<<stu.id<<","<<stu.gpa<<") ";});
    cout<<endl; // (Zero,101,4) (Mary,117,3.9) (Mary,102,3.8) (Ala,333,3.5) (Jack,112,3.4) 

    return 0;
}
```


  

