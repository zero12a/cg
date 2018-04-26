package com.ssg.cg.common;
import java.util.HashMap;
import java.util.ArrayList;
import java.util.List;
import org.springframework.stereotype.Repository;
@Repository
public interface Test3Mapper {

	//CUD : insert, update, delete

	/*SQLNM : 사용자등록*/
	public int insertUser(HashMap map);

	/*SQLNM : 사용자변경*/
	public int updateUser(HashMap map);

	/*SQLNM : 사용자삭제*/
	public int deleteUser(HashMap map);

	//R : select

	/*SQLNM : 사용자상세*/
	public HashMap<String,String> selectUserOne(HashMap map);

	/*SQLNM : 사용자목록*/
	public ArrayList<HashMap<String,String>> selectUserList(HashMap map);
}
