import './formGroup.styles.scss';

type FormGroupProps = {
  label: string;
  inputAttributes: React.AllHTMLAttributes<HTMLInputElement>;
}

const FormGroup = ({ label, inputAttributes }: FormGroupProps): JSX.Element => {
  return (
    <div className="form-group">
      <label>{label}</label>
      <input {...inputAttributes} />
    </div>
  );
}

export default FormGroup;
