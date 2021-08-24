# 不变序列算法

* 此类算法不会修改算法所作用的容器或对象，适用于所有容器， 时间复杂度都是O(n)的

* min: 求两个对象中较小的(可自定义比较器)

* max: 求两个对象中较大的(可自定义比较器)

* min_element： 求区间中的最小值(可自定义比较器)

* max_element: 求区间中的最大值(可自定义比较器)

* for_each: 对[first,last)中的每个元素 e ,执行 f(e) , 要求 f(e)不能改变e

  ```c++
  template<class InIt, class Fun> 
  Fun for_each(InIt first, InIt last, Fun f);
  ```

* find: 返回区间 [first,last) 中的迭代器 i ,使得 * i == val

  ```c++
  template<class InIt, class T> 
  InIt find(InIt first, InIt last, const T& val);
  ```

* find_if:  返回区间 [first,last) 中的迭代器 i, 使得 pr(*i) 

  ```c++
  template<class InIt, class Pred> 
  InIt find_if(InIt first, InIt last, Pred pr);
  ```

* count: 计算[first,last) 中等于val的元素个数

  ```c++
  template<class InIt, class T> 
  size_t count(InIt first, InIt last, const T& val);
  ```

* count_if：  计算[first,last) 中符合pr(e) == true 的元素 e的个数

  ```c++
  template<class InIt, class Pred> 
  size_t count_if(InIt first, InIt last, Pred pr);
  ```

  ```c++
  #include <iostream>
  #include <algorithm>
  #include <string>
  #include <vector>
  #include <array>
  using namespace std;
  
  bool greater10(int a) {
      return a > 10;
  }
  
  int main() {
      cout << min(23, 4) << endl; // 4
      cout << max(23, 22) << endl; // 23
      cout << min({101, 25, 20}, [](const int a, const int b){ return (a%10<b%10);}) << endl; // 20
  
      vector<string> s{"hello", "nice", "world", "nice", "nice", "hello"};
      cout << *min_element(s.begin(), s.end()) << endl; // hello
      cout << *max_element(s.begin(), s.end()) << endl; // world
  
      cout << count(s.begin(), s.end(), "nice") << endl; // 3
      cout << count_if(s.begin(), s.end(), [](const string& s1){ return (s1=="hello")||(s1=="nice");}) << endl; // 5
  
      cout << for_each(s.begin(), s.end(), [](const string& s1){cout<<s1<<" ";}); // hello nice world nice nice hello 1
      cout << endl;
  
      if (find(s.begin(), s.end(), "world")!=s.end()) {
          cout << "Found" << endl; // Found
      }
  
      if ( find_if(s.begin(), s.end(), [](const string& s1){return s1.size()>6;}) == s.end() ){
          cout << "Not found" << endl; // Not found
      }
  
      array<int, 6> arr{3, 4, 1, 6, 1, 5, 2};
      if( find_if(arr.begin(), arr.end(), greater10) != arr.end() ){
          cout << "Found large than 10" << endl;
      } else {
          cout << "Not found large than 10" << endl; // Not found large than 10
      }
  
  
      return 0;
  }
  ```

  

