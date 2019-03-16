create table [dbo].[Registration](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    nama VARCHAR(50),
    nim VARCHAR(50),
    npk VARCHAR(50),
    date DATE
);