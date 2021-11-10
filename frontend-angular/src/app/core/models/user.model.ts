import { Role } from './role.model';
import { Upload } from './upload.model';

export interface User {
  email: string;
  token: string;
  username: string;
  bio: string;
  image: string;
  role?: Role;
  file_id?: number;
  file?: Upload;
}
